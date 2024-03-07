<p align="center">
  <h1 align="center">Serial Lover - Backend</h1>
</p>

<p align="center">
  <img alt="Version v0.0.0" src="https://img.shields.io/static/v1?label=version&message=v0.0.0&color=black&style=for-the-badge&logo=symfony">
  <img alt="Continuous Integration status" src="https://img.shields.io/github/actions/workflow/status/Nolat/serial-lover/ci-backend.yml?branch=main&label=BACKEND%20CI&style=for-the-badge">
  <a href="https://github.com/Nolat/serial-lover/blob/main/LICENSE" target="_blank">
    <img alt="License: GPL-3.0" src="https://img.shields.io/github/license/Nolat/serial-lover?style=for-the-badge" target="_blank" />
  </a>
</p>

> ❤️ Small game made for the wedding of Rosene & Alexis

---

## What is this folder?

## This folder contains the Symfony backend of the application.

## Usage

### ⚡️ Running the development server

```bash
copier coller le .env et le rename .env.local et modifier les valeurs suivantes:
- APP_ENV = prod -> APP_ENV = dev
- DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8" -> DATABASE_URL="postgresql://username:password@127.0.0.1:5432/dbname"
- CORS_ALLOW_ORIGIN='^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$' -> CORS_ALLOW_ORIGIN='*'

lancer les commandes suivantes:
- composer install (install les bundles)
- php bin/console do:mi:mi (construction des tables)
- php bin/console do:fi:lo (insertion des datas par defaut/test)
- symfony server:start (start le server)
```

### ✅ Running the tests

```bash

```

### 🚀 Running the production server

```bash
- APP_ENV = prod dans le .env.local ou delete le .env.local
```

---

## 👥 Contributors

- [@Nolat](https://github.com/Nolat)
- [@BaptisteMag](https://github.com/BaptisteMag)

## 📝 License

Copyright © 2023 [Nolat](https://github.com/Nolat/serial-lover/blob/main/LICENSE).
