import { ChakraProvider } from "@chakra-ui/react";
import { useRoutes } from "react-router-dom";
import routes from "~react-pages";

import { theme } from "utils/theme";

export const App = () => {
  return (
    <ChakraProvider theme={theme} resetCSS>
      {useRoutes(routes)}
    </ChakraProvider>
  );
};
