/**
 * States Manager For WooCommerce Admin JavaScript
 * 
 * @package StatesManagerForWooCommerce
 * @license GPL-2.0+
 */

document.addEventListener('DOMContentLoaded', () => {
    // Constants for reusable selectors
    const SELECTORS = {
        form: '#statesManagerForm',
        toggleButtons: '.toggle-country',
        stateCheckboxes: '.state-checkbox',
        messageContainer: '#statesManagerMessages',
        countrySection: '.country-section',
        statesList: '.states-list li'
    };

    /**
     * Toggle all checkboxes for a specific country
     * @param {string} country - Country code
     * @param {boolean} select - Whether to select or deselect
     */
    const toggleCountryStates = (country, select) => {
        const checkboxes = document.querySelectorAll(
            `${SELECTORS.stateCheckboxes}[data-country="${country}"]`
        );
        checkboxes.forEach(checkbox => {
            checkbox.checked = select;
        });
        updateStateCounter(document.querySelector('.states-counter'));
    };

    /**
     * Initialize toggle buttons
     */
    const initializeToggleButtons = () => {
        document.querySelectorAll(SELECTORS.toggleButtons).forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const country = button.dataset.country;
                const select = button.dataset.select === 'all';
                toggleCountryStates(country, select);
            });
        });
    };

    /**
     * Initialize form submission handling
     */
    const initializeForm = () => {
        const form = document.querySelector(SELECTORS.form);
        if (form) {
            form.addEventListener('submit', (e) => {
                const checkedStates = document.querySelectorAll(`${SELECTORS.stateCheckboxes}:checked`);
                
                if (checkedStates.length === 0) {
                    const confirmMessage = 'You haven\'t selected any states. Are you sure you want to continue?';
                    if (!window.confirm(confirmMessage)) {
                        e.preventDefault();
                        return false;
                    }
                }
            });
        }
    };

    /**
     * Add search functionality for states
     */
    const initializeSearch = () => {
        const searchContainer = document.createElement('div');
        searchContainer.className = 'states-search';
        
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.placeholder = 'Search states...';
        searchInput.className = 'states-search-input';
        
        searchContainer.appendChild(searchInput);
        
        const form = document.querySelector(SELECTORS.form);
        if (form) {
            form.insertBefore(searchContainer, form.firstChild);
            
            let searchTimeout;
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const searchTerm = e.target.value.trim();
                    filterStates(searchTerm);
                }, 300);
            });
        }
    };

    /**
     * Filter states based on search term
     * @param {string} searchTerm 
     */
    const filterStates = (searchTerm) => {
        // Convert search term to lowercase for case-insensitive comparison
        const searchLower = searchTerm.toLowerCase();
        const searchTerms = searchLower.split(/\s+/).filter(term => term.length > 0);
        
        // Track visibility for each country section
        const countryVisibility = {};
        
        document.querySelectorAll(SELECTORS.statesList).forEach(stateItem => {
            const label = stateItem.querySelector('label');
            const countrySection = stateItem.closest(SELECTORS.countrySection);
            const countryName = countrySection.querySelector('h2').textContent.toLowerCase();
            const stateName = label.textContent.toLowerCase();
            
            // Initialize country visibility tracking
            const countryId = countrySection.id;
            if (!(countryId in countryVisibility)) {
                countryVisibility[countryId] = false;
            }
            
            let visible = false;
            
            if (searchTerms.length === 0) {
                // Show everything if search is empty
                visible = true;
            } else {
                // Check if ALL search terms match either state or country name
                visible = searchTerms.every(term => {
                    return stateName.includes(term) || countryName.includes(term);
                });
            }
            
            // Update state item visibility
            stateItem.style.display = visible ? '' : 'none';
            
            // Update country visibility tracking
            if (visible) {
                countryVisibility[countryId] = true;
            }
        });
        
        // Update country section visibility based on their states
        Object.entries(countryVisibility).forEach(([countryId, hasVisibleStates]) => {
            const countrySection = document.getElementById(countryId);
            if (countrySection) {
                countrySection.style.display = hasVisibleStates ? '' : 'none';
            }
        });
        
        // Update counters and UI state
        updateSearchResultsUI(Object.values(countryVisibility).some(visible => visible));
    };

    /**
     * Update UI elements based on search results
     * @param {boolean} hasResults 
     */
    const updateSearchResultsUI = (hasResults) => {
        const noResultsMessage = document.getElementById('noSearchResults');
        
        if (!hasResults) {
            if (!noResultsMessage) {
                const message = document.createElement('div');
                message.id = 'noSearchResults';
                message.className = 'no-results-message';
                message.textContent = 'No states found matching your search.';
                
                const form = document.querySelector(SELECTORS.form);
                form.insertBefore(message, form.querySelector('.country-section'));
            }
        } else if (noResultsMessage) {
            noResultsMessage.remove();
        }
    };

    /**
     * Add counter for selected states
     */
    const initializeStateCounter = () => {
        const counterContainer = document.createElement('div');
        counterContainer.className = 'states-counter';
        counterContainer.textContent = 'Selected states: 0';

        const form = document.querySelector(SELECTORS.form);
        if (form) {
            form.insertBefore(counterContainer, form.firstChild);

            // Update counter when checkboxes change
            document.addEventListener('change', (e) => {
                if (e.target.matches(SELECTORS.stateCheckboxes)) {
                    updateStateCounter(counterContainer);
                }
            });

            // Initial count
            updateStateCounter(counterContainer);
        }
    };

    /**
     * Update the state counter
     * @param {HTMLElement} counterContainer 
     */
    const updateStateCounter = (counterContainer) => {
        const checkedCount = document.querySelectorAll(`${SELECTORS.stateCheckboxes}:checked`).length;
        counterContainer.textContent = `Selected states: ${checkedCount}`;
    };

    // Initialize all features
    try {
        initializeToggleButtons();
        initializeForm();
        initializeSearch();
        initializeStateCounter();
    } catch (error) {
        console.error('Error initializing WC States Manager:', error);
    }
});