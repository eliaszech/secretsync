import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from "tailwindcss/colors.js";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/css/*.css',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Raleway', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            'background': '#212529',
            'accent': '#2a2e32',
            'accent-darker': '#272b2f',
            'primary': '#f84c48',
            gray: colors.gray,
            red: colors.red,
            black: colors.black,
            white: colors.white,
            transparent: colors.transparent,

            'theme-default': '#f84c48',
            'theme-blue': '#2563eb',
            'theme-orange': '#ea580c',
            'theme-green': '#16a34a',
            'theme-gray': '#71717a',
            'theme-white': '#fff',
            'theme-pink': '#9d174d',
            'theme-teal': '#115e59'
        }
    },

    plugins: [
        forms,
        require('tailwind-scrollbar'),
        require('tailwindcss-themer') ({
            defaultTheme: {
                extend: {
                    colors: {
                        primary: '#f84c48',
                        'primary-text': '#f84c48',
                        'primary-accent': '#f87171',
                        'accent-text': '#fff'
                    }
                }
            },
            themes: [
                {
                    name: 'blue',
                    extend: {
                        colors: {
                            primary: '#2563eb',
                            'primary-text': '#3b82f6',
                            'primary-accent': '#0ea5e9',
                        }
                    }
                },{
                    name: 'orange',
                    extend: {
                        colors: {
                            primary: '#ea580c',
                            'primary-text': '#f97316',
                            'primary-accent': '#fb923c'
                        }
                    }
                },{
                    name: 'green',
                    extend: {
                        colors: {
                            primary: '#16a34a',
                            'primary-text': '#16a34a',
                            'primary-accent': '#86efac',
                            'accent-text': '#fff'
                        }
                    }
                },{
                    name: 'gray',
                    extend: {
                        colors: {
                            primary: '#71717a',
                            "primary-text": '#a1a1aa',
                            'primary-accent': '#a1a1aa'
                        }
                    }
                },{
                    name: 'white',
                    extend: {
                        colors: {
                            primary: '#fff',
                            "primary-text": '#fff',
                            'primary-accent': '#fff',
                            'accent-text': '#000',
                        }
                    }
                },{
                    name: 'pink',
                    extend: {
                        colors: {
                            primary: '#9d174d',
                            "primary-text": '#db2777',
                            'primary-accent': '#be185d',
                            'accent-text': '#fff',
                        }
                    }
                },{
                    name: 'teal',
                    extend: {
                        colors: {
                            primary: '#115e59',
                            "primary-text": '#14b8a6',
                            'primary-accent': '#2dd4bf',
                            'accent-text': '#fff',
                        }
                    }
                }
            ]
        })
    ],
};
