import { ThemeConfig, extendTheme } from "@chakra-ui/react";

const config: ThemeConfig = {
  initialColorMode: "light",
  useSystemColorMode: false
};

const theme = extendTheme({
  config,
  colors: {
    black: "#110d03",
    white: "#fcf7ee",
    primary: {
      50: "#f6f7ee",
      100: "#eaedda",
      200: "#d6dcba",
      300: "#bbc591",
      400: "#a1ae6d",
      500: "#84934f",
      600: "#606c38",
      700: "#4f5a31",
      800: "#41492b",
      900: "#383f28",
      950: "#1d2112",
      DEFAULT: "#606c38"
    },
    secondary: {
      50: "#fcf8f0",
      100: "#f8eedc",
      200: "#f0dbb8",
      300: "#e7c28a",
      400: "#dda25f",
      500: "#d4863b",
      600: "#c66f30",
      700: "#a55729",
      800: "#844628",
      900: "#6b3b23",
      950: "#391c11",
      DEFAULT: "#dda25f"
    },
    accent: {
      50: "#fcf8ee",
      100: "#f6ebcf",
      200: "#ecd69b",
      300: "#e2bd67",
      400: "#dca643",
      500: "#d38a2d",
      600: "#bb6b25",
      700: "#9b4e22",
      800: "#7f3f21",
      900: "#69341e",
      950: "#3b1a0d"
    }
  }
});

export default theme;
