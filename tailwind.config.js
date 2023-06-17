module.exports = {
  content: ["./build/**/*.{php,js}"],
  theme: {
    container: {
      center: true,
      padding: "1.5rem",
      screens: {
        xs: "1000px",
        lg: "1125px",
        xl: "1280px",
      },
    },
    extend: {
      fontSize: {
        logo: [
          "1.5rem",
          {
            lineHeight: "2rem",
            letterSpacing: "1.5px",
            fontWeight: "700",
          },
        ],
      },
      colors: {
        "primary-500": "#0A20E6",
        "light-grey": "#F5F6F8",
        "grey-100": "#F6F7F9",
        "grey-500": "#A6AFBA",
        "grey-600": "#768898",
        "grey-700": "#4C5C6B",
        "grey-900": "#13171B",
        "red-300": "#F03D3D",
        "border-color": "#EEF0F1",
      },
      backgroundImage: {
        person1: "url('../imgs/Person-1.svg')",
        person2: "url('../imgs/Person-2.svg')",
        person3: "url('../imgs/Person-3.svg')",
        login: "url('../imgs/login.jpg')",
        signup: "url('../imgs/signup.jpg')",
      },
      fontFamily: {
        Jakarta: ["Plus Jakarta Sans", "sans-serif"],
        FontAwesome: ["Font Awesome 6 Free", "sans-serif"],
      },
      gradientColorStops: {
        DayBlue: "#4D62E5",
        Blue: "#87DDEE",
        Green500: "#B6F09C",
      },
      boxShadow: {
        activeInput: " 0px 0px 0px 4px rgba(132, 220, 245, 0.24)",
        "shadow-1":
          "0px 2px 4px rgba(76, 92, 107, 0.15), 0px 18px 36px rgba(166, 175, 186, 0.2)",
      },
      screens: {
        xs: "420px",
      },
    },
  },
  plugins: [],
};
