document.addEventListener('alpine:init', () => {
    Alpine.data('data', () => ({
        isProfileMenuOpen: false,
        dark: getThemeFromLocalStorage(),
        toggleTheme() {
            this.dark = !this.dark;
            console.log(this.dark);
            setThemeToLocalStorage(this.dark);
        },
        toggleProfileMenu() {
            this.isProfileMenuOpen = !this.isProfileMenuOpen;
        },
        closeProfileMenu() {
            this.isProfileMenuOpen = false;
        },
        isSideMenuOpen: false,
        toggleSideMenu() {
            this.isSideMenuOpen = !this.isSideMenuOpen;
        },
        closeSideMenu() {
            this.isSideMenuOpen = false;
        },
        isMultiLevelMenuOpen: false,
        toggleMultiLevelMenu() {
            this.isMultiLevelMenuOpen = !this.isMultiLevelMenuOpen;
        }
    }));

    function getThemeFromLocalStorage() {
        if (window.localStorage.getItem('dark')) {
            return JSON.parse(window.localStorage.getItem('dark'));
        }
        return (
            !!window.matchMedia &&
            window.matchMedia('(prefers-color-scheme: dark)').matches
        );
    }

    function setThemeToLocalStorage(value) {
        window.localStorage.setItem('dark', value);
    }
});
