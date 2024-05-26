import {
  Box,
  Flex,
  Icon,
  Input,
  InputGroup,
  InputLeftElement,
  useDisclosure,
  useTheme
} from "@chakra-ui/react";
import { UserSearch } from "lucide-react";
import { TypeAnimation } from "react-type-animation";

import LoginModal from "features/user/components/login-modal";

const Login = () => {
  const { isOpen, onOpen, onClose } = useDisclosure();

  const theme = useTheme();

  return (
    <Flex
      height="100vh"
      w="100%"
      justifyContent="flex-start"
      alignItems="center"
      flexDir="column"
      p={[4, 48]}
      mt={[16, 24]}
    >
      <Box h={[24, 16]} w="100%" textAlign="center">
        <TypeAnimation
          sequence={[
            "Qui sera le Serial Lover ? ❤️",
            2000,
            "Entrer votre nom & prénom pour participer"
          ]}
          cursor={false}
          repeat={0}
          wrapper="span"
          style={{
            fontWeight: "bold",
            fontSize: theme.fontSizes["3xl"],
            textAlign: "center",
            color: theme.colors.black
          }}
        />
      </Box>
      <InputGroup mt={[16]} size="lg">
        <InputLeftElement>
          <Icon as={UserSearch} boxSize={6} />
        </InputLeftElement>
        <Input placeholder="Qui es-tu ?" onClick={onOpen} />
      </InputGroup>

      <LoginModal isOpen={isOpen} onClose={onClose} />
    </Flex>
  );
};

export default Login;
