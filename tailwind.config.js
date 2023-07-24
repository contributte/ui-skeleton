const colors = require("tailwindcss/colors");

module.exports = {
	mode: "jit",
	content: [
		"./app/**/*.latte",
		"./app/**/*.php",
		"./assets/css/tailwind/**/*.css",
		"./assets/**/*.js",
	],
	safelist: [`
		hidden w-full border-0
		bg-vestra bg-man bg-woman bg-dead bg-success
		bg-screening
		bg-examination
		text-success text-vestra text-man text-woman
		text-dead text-info text-danger focus:ring-0
		rounded-l-md rounded-r-md
		xs:w-40 tap-highlight-transparent fix-ios-transforms
		bg-screening bg-examination
		fc-bg-0 fc-bg-1 fc-bg-2 fc-bg-3 fc-bg-4 fc-bg-5 fc-bg-6
		fc-bg-7 fc-bg-8 fc-bg-9 fc-bg-10 fc-bg-11 fc-bg-12 fc-bg-13
		fc-bg-14 fc-bg-15 fc-bg-16 fc-bg-17 fc-bg-18 fc-bg-19 fc-bg-20
		fc-bg-21 fc-bg-22 fc-bg-23 fc-bg-24 fc-bg-25 fc-bg-26 fc-bg-27
		fc-bg-28 fc-bg-29 fc-bg-30 fc-bg-31
		bg-0 bg-1 bg-2 bg-3 bg-4 bg-5 bg-6
		bg-7 bg-8 bg-9 bg-10 bg-11 bg-12 bg-13
		bg-14 bg-15 bg-16 bg-17 bg-18 bg-19 bg-20
		bg-21 bg-22 bg-23 bg-24 bg-25 bg-26 bg-27
		bg-28 bg-29 bg-30 bg-31
	`],
	theme: {
		screens: {
			xs: "414px",
			sm: "640px",
			md: "768px",
			lg: "1024px",
			xl: "1280px",
			"2xl": "1536px",
			"3xl": "1920px",
			"4xl": "2560px",
			"can-hover": { raw: "(hover: hover)" },
			touch: { raw: "(hover: none)" },
			'print': {'raw': 'print'},
		},
		colors: {
			transparent: "transparent",
			current: "currentColor",
			black: "#000",
			white: "#fff",
			brand: {
				50: "#FDFCFB",
				100: "#FBF1EE",
				200: "#F8CEDD",
				300: "#EFA0BA",
				400: "#E14B71",
				500: "#E14B71",
				600: "#CC3151",
				700: "#B11E3E",
				800: "#771A26",
				900: "#481014",
			},
			gray: colors.gray,
			blue: colors.sky,
			red: colors.red,
			orange: colors.orange,
			yellow: colors.amber,
			green: colors.emerald,
			vestra: '#2ec8dc',
			man: '#43a3c7',
			woman: '#DB2777',
			dead: '#2e2e2e',
			info: colors.sky[600],
			danger: colors.red[600],
			success: colors.green[600],
			dark: colors.gray[600]
		},
		fontFamily: {
			sans: [
				"Sora",
				"-apple-system",
				"BlinkMacSystemFont",
				'"Segoe UI"',
				"Roboto",
				'"Helvetica Neue"',
				"Arial",
				'"Noto Sans"',
				"sans-serif",
				'"Apple Color Emoji"',
				'"Segoe UI Emoji"',
				'"Segoe UI Symbol"',
				'"Noto Color Emoji"',
			],
		},
		extend: {
			margin: {
				'2px': '2px'
			},
			padding: {
				'2px': '2px',
				'3px': '3px'
			},
			minWidth: (theme) => ({
				...theme("spacing"),
				...theme("width"),
				...theme("maxWidth"),
				0: "0",
			}),
			minHeight: (theme) => ({
				...theme("spacing"),
				...theme("width"),
				...theme("maxWidth"),
			}),
			maxWidth: (theme) => ({
				...theme("spacing"),
				...theme("width"),
			}),
			width: (theme) => ({
				128: "32rem",
				160: "40rem",
				180: "45rem",
				200: "50rem",
			}),
			inset: (theme) => ({
				...theme("spacing"),
				...theme("width"),
				...theme("maxWidth")
			}),
			zIndex: {
				'-10': '-10',
				'60': '60',
				'70': '70',
				'80': '80',
				'90': '90',
				'100': '100'
			},
			boxShadow: {
				//'table-header': '0 1px 0px 0px rgba(31, 41, 55, 0.05), 0 3px 4px 1px rgba(31, 41, 55, 0.06)'
				'table-header': '0 1px 0px 0px rgba(31, 41, 55, 0.1)'
			}
		},
	},
	plugins: [
		require('@tailwindcss/forms'),
		require('@tailwindcss/line-clamp')
	]
};
