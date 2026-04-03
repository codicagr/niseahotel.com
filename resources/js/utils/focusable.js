const focusableSelector = `
    a[href],
    button:not([disabled]),
    input:not([disabled]):not([type="hidden"]),
    select:not([disabled]),
    textarea:not([disabled]),
    [tabindex]:not([tabindex="-1"]),
    [contenteditable="true"]
`;

/**
 * Get the first focusable child element of the given parent
 *
 * @param {HTMLElement|string} target
 * @param {boolean} shouldReturnRoot
 *
 * @return {HTMLElement|null}
 */
export default (target, shouldReturnRoot) => {
    if (target instanceof HTMLElement) {
        return shouldReturnRoot
            ? target
            : target.querySelector(focusableSelector) || target;
    }

    if (typeof target === 'string') {
        const element = document.querySelector(target);

        if (element instanceof HTMLElement) {
            return shouldReturnRoot
                ? element
                : element.querySelector(focusableSelector) || element;
        }
    }

    console.warn('(ERROR) Focusable: Invalid element or selector');
    return null;
}
