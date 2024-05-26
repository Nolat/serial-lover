import { Button, Center, Divider, Flex, Text } from "@chakra-ui/react";
import { useNavigate } from "react-router-dom";

const Page404 = () => {
  const navigate = useNavigate();

  return (
    <Flex
      height="100vh"
      w="100%"
      justifyContent="center"
      alignItems="center"
      flexDir="column"
    >
      <Flex w="80%" justifyContent="center" alignItems="center">
        <Center height="50px">
          <Text fontSize="3xl">404</Text>
          <Divider orientation="vertical" mr={4} ml={4} borderWidth={1} />
          <Text fontSize="lg">
            La page que vous rechercher n'a pas pu être trouvée
          </Text>
        </Center>
      </Flex>
      <Button
        mt="20"
        bg="primary.600"
        _hover={{ bg: "primary.900" }}
        color="white"
        onClick={() => navigate("/", { replace: true })}
      >
        Revenir à l'accueil
      </Button>
    </Flex>
  );
};

export default Page404;
