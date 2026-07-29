import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import glob from "fast-glob";

const cssFiles = glob.sync("resources/css/**/*.css");
const jsFiles = glob.sync("resources/js/**/*.js");

export default defineConfig({
  plugins: [
    laravel({
      input: [...cssFiles, ...jsFiles],
      refresh: true,
    }),
  ],
});
