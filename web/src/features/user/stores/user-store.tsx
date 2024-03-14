import type {} from "@redux-devtools/extension";
import { create } from "zustand";
import { devtools, persist } from "zustand/middleware";

interface UserState {
  user: string | undefined;
  setUser: (user: string) => void;
  resetUser: () => void;
}

export const userUserStore = create<UserState>()(
  devtools(
    persist(
      (set) => ({
        user: undefined,
        setUser: (user) => set({ user }),
        resetUser: () => set({ user: undefined })
      }),
      {
        name: "auth-storage"
      }
    ),
    { name: "user" }
  )
);
