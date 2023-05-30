# Installation de docker sur Debian 11

```bash
# Mise à jour des paquets
sudo apt update

sudo apt install apt-transport-https ca-certificates curl gnupg lsb-release
```

# Ajout de la clé GPG officielle de Docker

```bash
curl -fsSL https://download.docker.com/linux/debian/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker.gpg
```

# Ajout du dépôt stable de Docker

```bash
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker.gpg] https://download.docker.com/linux/debian $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
```

# Installation de Docker Engine et de ses dépendances 

```bash
sudo apt update
sudo apt install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

## Vérification de l'installation

```bash
sudo systemctl is-active docker
sudo docker run hello-world
``` 

# Ajout de l'utilisateur au groupe docker
Il faut ajouter l'utilisateur au groupe docker pour pouvoir utiliser docker sans utiliser sudo

```bash
sudo usermod -aG docker cookmaster
```

# Installation de docker-compose

```bash
sudo curl -L "https://github.com/docker/compose/releases/download/v2.10.2/docker-compose-linux-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

## Vérification de l'installation

```bash
docker-compose --version
```

# Démarrage automatique de docker au démarrage du système

```bash
sudo systemctl enable docker
```

# Listes des containers
    
```bash
docker ps
```

# Accéder a un container 

```bash
docker exec -it <nom-du-container> bash
```
