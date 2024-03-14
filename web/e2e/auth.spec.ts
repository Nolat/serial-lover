import { expect, test } from "playwright-test-coverage";

test.describe("Login process", () => {
  test("User is not logged in", async ({ page }) => {
    await page.goto("/");

    await expect(page).toHaveURL("/login");

    await expect(
      page.getByRole("button", { name: "Se connecter" })
    ).toBeVisible();
  });

  test("User logs in", async ({ page }) => {
    await page.goto("/login");
    await page.click("text=Se connecter");

    await expect(page).toHaveURL("/");

    await expect(
      page.getByRole("heading", { name: "Bienvenue" })
    ).toBeVisible();
  });

  test("User is logged in", async ({ page }) => {
    await page.goto("/");

    await expect(page).toHaveURL("/");

    await expect(
      page.getByRole("heading", { name: "Bienvenue" })
    ).toBeVisible();
  });

  test("User logs out", async ({ page }) => {
    await page.goto("/");
    await page.click("text=Se déconnecter");

    await expect(page).toHaveURL("/login");

    await expect(
      page.getByRole("button", { name: "Se connecter" })
    ).toBeVisible();
  });
});
