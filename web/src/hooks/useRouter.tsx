import { createBrowserRouter, redirect } from "react-router-dom";

import { userUserStore } from "features/user/stores/user-store";

import Home from "pages";
import PageNotFound from "pages/_404";
import Login from "pages/login";

export const useRouter = () => {
  const { user } = userUserStore();

  const router = createBrowserRouter([
    {
      path: "/",
      element: <Home />,
      errorElement: <PageNotFound />,
      loader: async () => {
        console.log("user", user);
        if (!user) {
          return redirect("/login");
        }

        return null;
      }
    },
    {
      path: "/login",
      element: <Login />
    }
  ]);

  return router;
};
