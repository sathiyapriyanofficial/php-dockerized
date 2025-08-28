EduPortal Docker Deployment

This repository contains a Dockerized EduPortal stack, including:
• PHP 8.4 + Apache / Nginx (FPM)
• MySQL 8.0
• Optional phpMyAdmin

It is designed for Ubuntu cloud deployment.

⸻

Project Structure

eduportal/
├── src/ # PHP application source code
├── Dockerfile # PHP-FPM or Apache container
├── docker-compose.yml # Docker services configuration
├── nginx/ # Nginx config (if using FPM)
│ └── nginx.conf
└── .env # Environment variables (DB credentials, etc.)

⸻

Prerequisites (Ubuntu Server) 1. Ubuntu 22.04 or similar 2. SSH access to server 3. Open ports:
• 80 (HTTP)
• 443 (HTTPS, optional)
• 3306 (MySQL, optional if remote access needed)

⸻

Installation Steps

1. SSH into the server

ssh username@your-server-ip

2. Update system

sudo apt update && sudo apt upgrade -y

3. Install Docker & Docker Compose

sudo apt install -y docker.io
sudo systemctl enable docker
sudo systemctl start docker

sudo curl -L "https://github.com/docker/compose/releases/download/v2.18.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
docker-compose --version

4. Deploy the project
   • Clone your repository or copy files:

git clone https://github.com/yourusername/eduportal.git
cd eduportal

    •	Ensure .env exists with proper DB credentials.

5. Start the Docker stack

docker-compose up -d --build

    •	Verify containers:

docker ps

⸻

Optional: Add phpMyAdmin

Add this service to docker-compose.yml:

phpmyadmin:
image: phpmyadmin/phpmyadmin
container_name: phpmyadmin
restart: always
ports: - "8081:80"
environment:
PMA_HOST: db
PMA_PORT: 3306
depends_on: - db

Access phpMyAdmin at: http://your-server-ip:8081

⸻

Managing the Stack

Command Description
docker-compose up -d --build Build & start containers
docker-compose down Stop & remove containers
docker-compose restart Restart containers
docker-compose logs -f Stream logs

⸻

Optional: Systemd Auto-Start

Create a systemd service /etc/systemd/system/eduportal.service:

[Unit]
Description=EduPortal Docker Stack
After=docker.service
Requires=docker.service

[Service]
WorkingDirectory=/opt/eduportal
ExecStart=/usr/local/bin/docker-compose up
ExecStop=/usr/local/bin/docker-compose down
Restart=always

[Install]
WantedBy=multi-user.target

Enable & start:

sudo systemctl daemon-reload
sudo systemctl enable eduportal
sudo systemctl start eduportal

⸻

Notes 1. PHP-FPM container: connect to MySQL at db:3306 2. MySQL credentials come from .env or docker-compose.yml 3. Volumes persist MySQL data between restarts (db_data) 4. Optional domain + SSL: use Nginx reverse proxy + Let’s Encrypt

⸻

Access
• App: http://your-server-ip:80
• phpMyAdmin: http://your-server-ip:8081 (if configured)
