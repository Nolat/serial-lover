import { Flex } from "@chakra-ui/react";
import { Navigate } from "react-router-dom";

import Header from "features/layout/components/header";
import TargetInfo from "features/mission/components/target-info";
import { useRulesStore } from "features/rules/stores/rules-store";

const Home = () => {
  const { hasAcceptedRules } = useRulesStore();

  if (!hasAcceptedRules) {
    return <Navigate to="/rules" />;
  }

  return (
    <Flex flexDir="column">
      <Header />

      <TargetInfo />
    </Flex>
  );
};

export default Home;
