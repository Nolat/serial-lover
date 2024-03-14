import { expect, test } from "playwright-test-coverage";

test("404 page", async ({ page }) => {
  await page.goto("/");

  await page.goto("/non-existing-page");

  await expect(page.getByText("404")).toBeVisible();
  await expect(
    page.getByText("La page que vous rechercher n'a pas pu être trouvée")
  ).toBeVisible();

  await expect(
    page.getByRole("button", { name: "Revenir à l'accueil" })
  ).toBeVisible();
  await page.click("text=Revenir à l'accueil");
});
