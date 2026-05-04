/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './**/*.php',
    './src/**/*.{js,ts}',
    './block-patterns/**/*.php',
    './page-templates/**/*.php',
    './template-parts/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        // Brand sky-blue palette anchored at 500 (#58a9dc)
        primary: {
          50: '#f0f8fd',
          100: '#d9eef9',
          200: '#b3dcf2',
          300: '#88c8e8',
          400: '#6cb9e0',
          500: '#58a9dc',
          600: '#3589c1',
          700: '#2a6ea0',
          800: '#235a82',
          900: '#1d4969',
          950: '#102d44',
        },
        accent: {
          DEFAULT: '#fcc800',
          50: '#fffce5',
          100: '#fff8c2',
          200: '#ffef85',
          300: '#ffe247',
          400: '#fcd419',
          500: '#fcc800',
          600: '#d19a00',
          700: '#a66e02',
          800: '#89560a',
          900: '#74460f',
        },
        // Historical name kept for backwards-compat with existing classes;
        // re-anchored to the new sky-blue family. DEFAULT = primary-800
        // so dark surfaces (hero, drawer, dropdown accent) keep ≥4.5:1
        // contrast against white text.
        'accent-green': {
          DEFAULT: '#235a82',
          50: '#f0f8fd',
          100: '#d9eef9',
          200: '#b3dcf2',
          300: '#88c8e8',
          400: '#6cb9e0',
          500: '#58a9dc',
          600: '#3589c1',
          700: '#2a6ea0',
          800: '#235a82',
          900: '#1d4969',
        },
        dark: {
          DEFAULT: '#192a3d',
          50: '#f0f5fa',
          100: '#dce7f2',
          200: '#c0d4e8',
          300: '#95b8d7',
          400: '#6394c2',
          500: '#4077ad',
          600: '#305f92',
          700: '#294d77',
          800: '#254163',
          900: '#192a3d',
        },
        warm: {
          50: '#faf8f5',
          100: '#f4eee0',
          200: '#ebe1cc',
        },
      },
      fontFamily: {
        sans: [
          '"Noto Sans TC"',
          'Roboto',
          '"Open Sans"',
          'ui-sans-serif',
          'system-ui',
          'sans-serif',
        ],
      },
      fontSize: {
        'display': ['3.5rem', { lineHeight: '1.2', fontWeight: '700' }],
        'h1': ['2.5rem', { lineHeight: '1.3', fontWeight: '700' }],
        'h2': ['2rem', { lineHeight: '1.35', fontWeight: '600' }],
        'h3': ['1.5rem', { lineHeight: '1.4', fontWeight: '600' }],
        'h4': ['1.25rem', { lineHeight: '1.5', fontWeight: '600' }],
        'body-lg': ['1.125rem', { lineHeight: '1.75' }],
        'body': ['1rem', { lineHeight: '1.75' }],
        'body-sm': ['0.875rem', { lineHeight: '1.625' }],
      },
      spacing: {
        'section': '5rem',
        'section-sm': '3rem',
        'section-xs': '2rem',
      },
      borderRadius: {
        'card': '0.75rem',
      },
      boxShadow: {
        'card': '0 4px 6px -1px rgba(25, 42, 61, 0.08), 0 2px 4px -2px rgba(25, 42, 61, 0.05)',
        'card-hover': '0 10px 15px -3px rgba(25, 42, 61, 0.12), 0 4px 6px -4px rgba(25, 42, 61, 0.07)',
        'header': '0 2px 8px rgba(25, 42, 61, 0.08)',
      },
      maxWidth: {
        'content': '75rem',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}
