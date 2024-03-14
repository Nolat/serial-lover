import { inputAnatomy } from "@chakra-ui/anatomy";
import { createMultiStyleConfigHelpers } from "@chakra-ui/react";

const { definePartsStyle, defineMultiStyleConfig } =
  createMultiStyleConfigHelpers(inputAnatomy.keys);

const outline = definePartsStyle({
  field: {
    // _focus: {
    //   borderColor: "primary.500",
    //   boxShadow: "0 0 0 1px primary.500"
    // },
    _focusVisible: {
      // zIndex: 1,
      // borderColor: "primary.600",
      // boxShadow: "0 0 0 1px primary.600"
    }
  }
});

const variants = { outline };

const Input = defineMultiStyleConfig({ variants });

export default Input;
