import type {} from "@redux-devtools/extension";
import { create } from "zustand";
import { devtools, persist } from "zustand/middleware";

interface RulesState {
  hasAcceptedRules: boolean;
  acceptRules: () => void;
  resetRules: () => void;
}

export const useRulesStore = create<RulesState>()(
  devtools(
    persist(
      (set) => ({
        hasAcceptedRules: false,
        acceptRules: () => set({ hasAcceptedRules: true }),
        resetRules: () => set({ hasAcceptedRules: false })
      }),
      {
        name: "rules-storage"
      }
    ),
    { name: "rules" }
  )
);
