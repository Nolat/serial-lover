import { Box, Button, Flex, HStack, useTheme } from "@chakra-ui/react";
import { Check, X } from "lucide-react";
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { TypeAnimation } from "react-type-animation";

import { useRulesStore } from "features/rules/stores/rules-store";
import { useUserStore } from "features/user/stores/user-store";

const Rules = () => {
  const theme = useTheme();

  const { user, resetUser } = useUserStore();

  const { acceptRules, resetRules } = useRulesStore();

  const navigate = useNavigate();

  const [isAnimationDone, setIsAnimationDone] = useState(false);

  const yes = () => {
    acceptRules();
    navigate("/");
  };

  const no = () => {
    resetUser();
    navigate("/login");
    resetRules();
  };

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
      <Box w="100%" textAlign="center" mb={16}>
        <TypeAnimation
          sequence={[
            `Bonjour Agent ${user?.firstname}`,
            1000,
            `Bonjour Agent ${user?.firstname}\n\n Les règles du Serial Lover sont très simples. Tu vas recevoir le nom d'une cible et une action à réaliser avec elle. Une fois l'action réalisée, il te suffira d'entrer le code affichée sur le téléphone de ta cible pour valider ta mission.\n\nTon objectif est de réaliser le plus de mission possible et de rencontrer le plus d'invités.`,
            1000,
            `Bonjour Agent ${user?.firstname}\n\n Les règles du Serial Lover sont très simples. Tu vas recevoir le nom d'une cible et une action à réaliser avec elle. Une fois l'action réalisée, il te suffira d'entrer le code affichée sur le téléphone de ta cible pour valider ta mission.\n\nTon objectif est de réaliser le plus de mission possible et de rencontrer le plus d'invités.\n\nEs-tu près à recevoir ta première mission ?`,
            1000,
            () => setIsAnimationDone(true)
          ]}
          cursor={false}
          speed={70}
          repeat={0}
          wrapper="span"
          style={{
            whiteSpace: "pre-line",
            fontSize: theme.fontSizes["lg"],
            textAlign: "center",
            color: theme.colors.black
          }}
        />
      </Box>

      {isAnimationDone && (
        <HStack spacing={4}>
          <Button bg="olive.600" w="20vh" leftIcon={<Check />} onClick={yes}>
            Oui
          </Button>
          <Button bg="cocoa.600" w="20vh" leftIcon={<X />} onClick={no}>
            Non
          </Button>
        </HStack>
      )}
    </Flex>
  );
};

export default Rules;
