import { ChakraProvider } from "@chakra-ui/react";
import { useRouter } from "hooks";
import { RouterProvider } from "react-router-dom";

import { theme } from "utils/theme";

export const App = () => {
  const router = useRouter();

  return (
    <ChakraProvider theme={theme} resetCSS>
      <RouterProvider router={router} />
    </ChakraProvider>
  );
};
