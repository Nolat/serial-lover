import { Button, Flex, Icon, IconButton } from "@chakra-ui/react";
import { BarChart3, LogOut } from "lucide-react";
import { useNavigate } from "react-router-dom";

import { useRulesStore } from "features/rules/stores/rules-store";
import { useUserStore } from "features/user/stores/user-store";

const Header = () => {
  const { resetUser } = useUserStore();

  const { resetRules } = useRulesStore();

  const navigate = useNavigate();

  const logout = () => {
    resetUser();
    resetRules();
    navigate("/login");
  };

  return (
    <Flex justifyContent="space-between" px={4} pb={8} pt={4}>
      <Button bg="olive.600" leftIcon={<Icon as={BarChart3} color="white" />}>
        Classement
      </Button>
      <IconButton
        icon={<Icon as={LogOut} color="white" />}
        aria-label="Se déconnecter"
        bg="olive.600"
        onClick={logout}
      />
    </Flex>
  );
};

export default Header;
