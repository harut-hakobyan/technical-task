chmod +x update.env.sh
bash update.env.sh
docker compose build
docker compose -f docker-compose.yml up --remove-orphans