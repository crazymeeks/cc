# System requirements
- PHP8.x

# Installation

### If you're on using Ubuntu, just install Docker and docker compose then run the following commands:
**Step1: Clone this repository**

**Step2: Create docker network**
```bash
docker network create \
  --driver=bridge \
  --subnet=172.28.0.0/16 \
  --ip-range=172.28.5.0/24 \
  --gateway=172.28.5.254 \
  devnetwork
```
**Step3: Create .env file then copy/paste here the content from .env.example**

**Step4: Build container, run below commands step by step**
```bash
- docker compose build
- docker compose up -d
- docker exec -it cc-172.28.0.201 bash
- composer install
- php artisan migrate
```
**Step5: Migrate data. Please note that the last command would take some time because of more than 7 Millions of data being imported.**

```bash
- php artisan import:teams
- php artisan import:players
- php artisan import_matches
- php artisan import:stats
```

**After importing(done with step 5), you may visit http://172.28.0.201/ in your browser**