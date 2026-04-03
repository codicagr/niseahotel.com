import { gsap } from "gsap";

/**
 * @typedef {Object} HorizontalLoopConfig
 * @property {number} [speed=1] - Speed multiplier for the animation
 * @property {number} [repeat=-1] - Number of times to repeat (-1 for infinite)
 * @property {boolean} [paused=false] - Whether to start paused
 * @property {number|boolean} [snap=1] - Snap value for pixel alignment (false to disable)
 * @property {number} [paddingRight=0] - Extra padding after the last item
 * @property {boolean} [reversed=false] - Whether to play in reverse
 */

/**
 * @typedef {Object} SmoothControlVars
 * @property {number} [duration=0.5] - Duration of the smooth transition
 * @property {string} [ease="power2.out"] - GSAP easing function
 * @property {Function} [onComplete] - Callback when animation completes
 * @property {Function} [onStart] - Callback when animation starts
 * @property {Function} [onUpdate] - Callback on each animation update
 */

/**
 * @typedef {Object} ToIndexVars
 * @property {number} [duration] - Duration of the transition
 * @property {string} [ease] - GSAP easing function
 * @property {Function} [onComplete] - Callback when animation completes
 * @property {boolean} [overwrite] - Whether to overwrite existing tweens
 */

/**
 * HorizontalLoop - Creates an infinite horizontal looping animation
 *
 * @class
 * @example
 * const loop = new HorizontalLoop(".item", { speed: 1 });
 * loop.smoothPause({ duration: 0.6, ease: "power2.out" });
 * loop.smoothPlay({ duration: 0.6, ease: "power2.inOut" });
 */
export class HorizontalLoop {
    /**
     * Creates a new HorizontalLoop instance
     * @param {string|Element|Element[]} items - CSS selector, element, or array of elements
     * @param {HorizontalLoopConfig} [config={}] - Configuration options
     */
    constructor(items, config = {}) {
        /** @type {Element[]} */
        this._items = gsap.utils.toArray(items);

        /** @type {HorizontalLoopConfig} */
        this._config = {
            speed: 1,
            repeat: -1,
            paused: false,
            snap: 1,
            paddingRight: 0,
            reversed: false,
            ...config
        };

        /** @type {gsap.core.Timeline} */
        this._timeline = null;

        /** @type {number} */
        this._currentIndex = 0;

        /** @type {'pause'|'play'|null} */
        this._smoothIntent = null;

        /** @type {number} */
        this._fullSpeed = 1;

        /** @type {number[]} */
        this._times = [];

        /** @type {number[]} */
        this._widths = [];

        /** @type {number[]} */
        this._xPercents = [];

        this._initialize();
    }

    /**
     * Initializes the loop animation
     * @private
     * @returns {void}
     */
    _initialize() {
        const pixelsPerSecond = this._config.speed * 100;
        const snap = this._config.snap === false
            ? (v) => v
            : gsap.utils.snap(this._config.snap);

        // Create timeline
        this._timeline = gsap.timeline({
            repeat: this._config.repeat,
            paused: this._config.paused,
            defaults: { ease: "none" },
            onReverseComplete: () => {
                this._timeline.totalTime(
                    this._timeline.rawTime() + this._timeline.duration() * 100
                );
            }
        });

        // Calculate and set initial positions
        this._calculatePositions(snap);

        // Calculate total width
        const totalWidth = this._calculateTotalWidth();

        // Build animation timeline
        this._buildTimeline(pixelsPerSecond, totalWidth, snap);

        // Pre-render
        this._timeline.progress(1, true).progress(0, true);

        // Handle reversed config
        if (this._config.reversed) {
            this._timeline.vars.onReverseComplete();
            this._timeline.reverse();
        }
    }

    /**
     * Calculates initial positions and dimensions for all items
     * @private
     * @param {Function} snap - Snap function for pixel alignment
     * @returns {void}
     */
    _calculatePositions(snap) {
        // Convert "x" to "xPercent" and populate widths/xPercents
        gsap.set(this._items, {
            xPercent: (i, el) => {
                const width = parseFloat(gsap.getProperty(el, "width", "px"));
                this._widths[i] = width;

                const x = parseFloat(gsap.getProperty(el, "x", "px"));
                const xPercent = gsap.getProperty(el, "xPercent");

                this._xPercents[i] = snap((x / width) * 100 + xPercent);
                return this._xPercents[i];
            }
        });

        gsap.set(this._items, { x: 0 });
    }

    /**
     * Calculates the total width of all items
     * @private
     * @returns {number} Total width in pixels
     */
    _calculateTotalWidth() {
        const lastIndex = this._items.length - 1;
        const lastItem = this._items[lastIndex];
        const startX = this._items[0].offsetLeft;

        return (
            lastItem.offsetLeft +
            (this._xPercents[lastIndex] / 100) * this._widths[lastIndex] -
            startX +
            lastItem.offsetWidth * gsap.getProperty(lastItem, "scaleX") +
            parseFloat(this._config.paddingRight)
        );
    }

    /**
     * Builds the looping animation timeline
     * @private
     * @param {number} pixelsPerSecond - Animation speed in pixels per second
     * @param {number} totalWidth - Total width of all items
     * @param {Function} snap - Snap function for pixel alignment
     * @returns {void}
     */
    _buildTimeline(pixelsPerSecond, totalWidth, snap) {
        const startX = this._items[0].offsetLeft;

        this._items.forEach((item, i) => {
            const width = this._widths[i];
            const xPercent = this._xPercents[i];
            const currentX = (xPercent / 100) * width;
            const distanceToStart = item.offsetLeft + currentX - startX;
            const distanceToLoop = distanceToStart + width * gsap.getProperty(item, "scaleX");

            // Animate to loop point
            this._timeline.to(
                item,
                {
                    xPercent: snap(((currentX - distanceToLoop) / width) * 100),
                    duration: distanceToLoop / pixelsPerSecond
                },
                0
            );

            // Animate from restart position back to original
            this._timeline.fromTo(
                item,
                {
                    xPercent: snap(((currentX - distanceToLoop + totalWidth) / width) * 100)
                },
                {
                    xPercent,
                    duration: (currentX - distanceToLoop + totalWidth - currentX) / pixelsPerSecond,
                    immediateRender: false
                },
                distanceToLoop / pixelsPerSecond
            );

            this._timeline.add(`label${i}`, distanceToStart / pixelsPerSecond);
            this._times[i] = distanceToStart / pixelsPerSecond;
        });
    }

    /**
     * Animates to a specific item index
     * @private
     * @param {number} index - Target index
     * @param {ToIndexVars} [vars={}] - Animation parameters
     * @returns {gsap.core.Tween} The tween animation
     */
    _toIndex(index, vars = {}) {
        const length = this._items.length;
        let targetIndex = index;

        // Find shortest direction
        if (Math.abs(targetIndex - this._currentIndex) > length / 2) {
            targetIndex += targetIndex > this._currentIndex ? -length : length;
        }

        const newIndex = gsap.utils.wrap(0, length, targetIndex);
        let time = this._times[newIndex];

        // Handle playhead wrapping
        if ((time > this._timeline.time()) !== (targetIndex > this._currentIndex)) {
            vars.modifiers = { time: gsap.utils.wrap(0, this._timeline.duration()) };
            time += this._timeline.duration() * (targetIndex > this._currentIndex ? 1 : -1);
        }

        this._currentIndex = newIndex;
        vars.overwrite = true;

        return this._timeline.tweenTo(time, vars);
    }

    // Public API - Navigation

    /**
     * Animates to the next item
     * @param {ToIndexVars} [vars] - Animation parameters
     * @returns {gsap.core.Tween} The tween animation
     */
    next(vars) {
        return this._toIndex(this._currentIndex + 1, vars);
    }

    /**
     * Animates to the previous item
     * @param {ToIndexVars} [vars] - Animation parameters
     * @returns {gsap.core.Tween} The tween animation
     */
    previous(vars) {
        return this._toIndex(this._currentIndex - 1, vars);
    }

    /**
     * Animates to a specific item index
     * @param {number} index - Target index (0-based)
     * @param {ToIndexVars} [vars] - Animation parameters
     * @returns {gsap.core.Tween} The tween animation
     */
    toIndex(index, vars) {
        return this._toIndex(index, vars);
    }

    /**
     * Gets the current item index
     * @returns {number} Current index (0-based)
     */
    current() {
        return this._currentIndex;
    }

    // Public API - Smooth controls

    /**
     * Smoothly decelerates the loop to a pause
     * @param {SmoothControlVars} [vars={}] - Animation parameters
     * @returns {gsap.core.Tween} The tween animation
     */
    smoothPause(vars = {}) {
        const { duration = 0.5, ease = "power2.out", onComplete, ...rest } = vars;

        this._smoothIntent = "pause";
        gsap.killTweensOf(this._timeline);

        // Already paused
        if (this._timeline.timeScale() === 0 || this._timeline.paused()) {
            this._timeline.pause();
            this._timeline.timeScale(0);
            return gsap.delayedCall(0, () => {});
        }

        // Ensure playing state for timeScale animation
        if (this._timeline.paused()) {
            this._timeline.play();
        }

        return gsap.to(this._timeline, {
            timeScale: 0,
            duration,
            ease,
            ...rest,
            onComplete: () => {
                if (this._smoothIntent === "pause") {
                    this._timeline.pause();
                    this._timeline.timeScale(0);
                }
                onComplete?.call(this._timeline);
            }
        });
    }

    /**
     * Smoothly accelerates the loop back to full speed
     * @param {SmoothControlVars} [vars={}] - Animation parameters
     * @returns {gsap.core.Tween} The tween animation
     */
    smoothPlay(vars = {}) {
        const { duration = 0.5, ease = "power2.inOut", onStart, ...rest } = vars;

        this._smoothIntent = "play";
        gsap.killTweensOf(this._timeline);

        const startScale = this._timeline.timeScale();

        return gsap.to(this._timeline, {
            timeScale: this._fullSpeed,
            duration,
            ease,
            ...rest,
            onStart: () => {
                if (this._timeline.paused()) {
                    // Nudge timeScale if at zero for smooth interpolation
                    if (startScale === 0) {
                        this._timeline.timeScale(0.0001);
                    }
                    this._timeline.play();
                }
                onStart?.call(this._timeline);
            }
        });
    }

    /**
     * Toggles between smooth play and pause
     * @param {SmoothControlVars} [vars={}] - Animation parameters
     * @returns {gsap.core.Tween} The tween animation
     */
    smoothToggle(vars = {}) {
        const isPlaying = !this._timeline.paused() && this._timeline.timeScale() > 0.001;
        return isPlaying ? this.smoothPause(vars) : this.smoothPlay(vars);
    }

    // Public API - Direct timeline controls

    /**
     * Plays the timeline
     * @returns {gsap.core.Timeline} The timeline instance
     */
    play() {
        return this._timeline.play();
    }

    /**
     * Pauses the timeline
     * @returns {gsap.core.Timeline} The timeline instance
     */
    pause() {
        return this._timeline.pause();
    }

    /**
     * Reverses the timeline
     * @returns {gsap.core.Timeline} The timeline instance
     */
    reverse() {
        return this._timeline.reverse();
    }

    /**
     * Restarts the timeline
     * @returns {gsap.core.Timeline} The timeline instance
     */
    restart() {
        return this._timeline.restart();
    }

    // Public API - Timeline access

    /**
     * Gets the underlying GSAP timeline
     * @returns {gsap.core.Timeline} The timeline instance
     */
    get timeline() {
        return this._timeline;
    }

    /**
     * Gets a copy of the timing array for each item
     * @returns {number[]} Array of times when each item starts
     */
    get times() {
        return [...this._times];
    }

    /**
     * Gets the array of item elements
     * @returns {Element[]} Array of elements being animated
     */
    get items() {
        return [...this._items];
    }

    /**
     * Checks if the loop is currently paused
     * @returns {boolean} True if paused
     */
    get isPaused() {
        return this._timeline.paused() || this._timeline.timeScale() === 0;
    }

    /**
     * Checks if the loop is currently playing
     * @returns {boolean} True if playing
     */
    get isPlaying() {
        return !this._timeline.paused() && this._timeline.timeScale() > 0;
    }

    // Public API - Cleanup

    /**
     * Destroys the loop and cleans up all animations
     * @returns {void}
     */
    kill() {
        gsap.killTweensOf(this._timeline);
        this._timeline.kill();
    }
}
