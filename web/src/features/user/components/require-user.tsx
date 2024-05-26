import { Navigate } from "react-router-dom";

import { useUserStore } from "../stores/user-store";

const RequireUser: React.FC<RequireUserProps> = ({
  children,
  fallbackPath
}) => {
  const { user } = useUserStore();

  if (!user) {
    return <Navigate to={fallbackPath} replace />;
  }

  return children;
};

export default RequireUser;

type RequireUserProps = {
  children: React.ReactNode;
  fallbackPath: string;
};
