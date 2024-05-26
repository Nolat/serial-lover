import { Box, Button, Heading } from "@chakra-ui/react";
import { useNavigate } from "react-router-dom";

import { userUserStore } from "features/user/stores/user-store";

const Home = () => {
  const { resetUser } = userUserStore();

  const navigate = useNavigate();

  const logout = () => {
    resetUser();
    navigate("/login");
  };

  return (
    <Box bg="white">
      <Heading as="h1" color="black">
        Bienvenue
      </Heading>

      <Button
        mt="20"
        bg="primary.600"
        _hover={{ bg: "primary.900" }}
        color="white"
        onClick={logout}
      >
        Se déconnecter
      </Button>
    </Box>
  );
};

export default Home;
