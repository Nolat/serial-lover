import type {} from "@redux-devtools/extension";
import { create } from "zustand";
import { devtools, persist } from "zustand/middleware";

interface UserState {
  user: Player | undefined;
  setUser: (user: Player) => void;
  resetUser: () => void;
}

export const useUserStore = create<UserState>()(
  devtools(
    persist(
      (set) => ({
        user: undefined,
        setUser: (user: Player) => set({ user }),
        resetUser: () => set({ user: undefined })
      }),
      {
        name: "user-storage"
      }
    ),
    { name: "user" }
  )
);
