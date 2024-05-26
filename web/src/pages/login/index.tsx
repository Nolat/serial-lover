import { Box, Button } from "@chakra-ui/react";
import { useNavigate } from "react-router-dom";

import { userUserStore } from "features/user/stores/user-store";

const Login = () => {
  const { setUser } = userUserStore();

  const navigate = useNavigate();

  const login = () => {
    setUser("user");
    navigate("/");
  };

  return (
    <Box bg="white">
      <Button
        mt="20"
        bg="primary.600"
        _hover={{ bg: "primary.900" }}
        color="white"
        onClick={login}
      >
        Se connecter
      </Button>
    </Box>
  );
};

export default Login;
