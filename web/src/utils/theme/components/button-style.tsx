import { defineStyleConfig } from "@chakra-ui/react";

const Button = defineStyleConfig({
  variants: {
    solid: {
      bg: "primary.600",
      _hover: { bg: "primary.900" },
      color: "white"
    }
  }
});

export default Button;
