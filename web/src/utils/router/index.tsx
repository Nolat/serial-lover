import { BrowserRouter, Route, Routes } from "react-router-dom";

import RequireUser from "features/user/components/require-user";

import Home from "pages";
import PageNotFound from "pages/_404";
import Login from "pages/login";
import Rules from "pages/rules";

const Router = () => {
  return (
    <BrowserRouter future={{ v7_startTransition: true }}>
      <Routes>
        <Route
          index
          path={"/"}
          element={
            <RequireUser fallbackPath={"/login"}>
              <Home />
            </RequireUser>
          }
        />
        <Route path="/login" element={<Login />} />
        <Route path="/rules" element={<Rules />} />
        <Route path="*" element={<PageNotFound />} />
      </Routes>
    </BrowserRouter>
  );
};

export default Router;
