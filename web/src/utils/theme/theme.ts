import {
  Button,
  Icon,
  Input,
  Text,
  ThemeConfig,
  extendTheme
} from "@chakra-ui/react";

const config: ThemeConfig = {
  initialColorMode: "light",
  useSystemColorMode: false
};

Button.defaultProps = {
  bg: "olive.500",
  _hover: { bg: "olive.900" },
  color: "white"
};

Icon.defaultProps = {
  color: "cocoa.900"
};

Input.defaultProps = {
  focusBorderColor: "olive.600"
};

Text.defaultProps = {
  color: "black"
};

const theme = extendTheme({
  config,
  colors: {
    black: "#110d03",
    white: "#fcf7ee",
    cocoa: {
      "50": "#fcfbf8",
      "100": "#faf0dc",
      "200": "#f5d8b5",
      "300": "#e5af82",
      "400": "#d78153",
      "500": "#c15e32",
      "600": "#a34421",
      "700": "#7d331a",
      "800": "#562313",
      "900": "#36150c"
    },
    olive: {
      "50": "#f8f9f5",
      "100": "#f1f0e0",
      "200": "#dee1bb",
      "300": "#b7c087",
      "400": "#809a57",
      "500": "#607b33",
      "600": "#4c6123",
      "700": "#3c491d",
      "800": "#293217",
      "900": "#1b1e10"
    },
    gold: {
      "50": "#fbfaf6",
      "100": "#f7efd3",
      "200": "#eedba6",
      "300": "#d7b672",
      "400": "#ba8c45",
      "500": "#9c6c28",
      "600": "#80521a",
      "700": "#623d16",
      "800": "#432a12",
      "900": "#2b1a0c"
    },
    gray: {
      "50": "#f9fafb",
      "100": "#f3f4f6",
      "200": "#e5e7eb",
      "300": "#d1d5db",
      "400": "#9ca3af",
      "500": "#6b7280",
      "600": "#4b5563",
      "700": "#374151",
      "800": "#1f2937",
      "900": "#111827",
      "950": "#030712"
    }
  }
});

export default theme;
