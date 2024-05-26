import react from "@vitejs/plugin-react";
import { defineConfig } from "vite";
import istanbul from "vite-plugin-istanbul";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    react(),
    istanbul({
      include: ["src/**/*.{js,jsx,ts,tsx}"],
      exclude: ["!**/node_modules/**", "!**/*.d.ts"],
      requireEnv: false
    })
  ],
  resolve: {
    alias: {
      app: "/src/app",
      assets: "/src/assets",
      components: "/src/components",
      features: "/src/features",
      hooks: "/src/hooks",
      lib: "/src/lib",
      pages: "/src/pages",
      utils: "/src/utils"
    }
  }
});
