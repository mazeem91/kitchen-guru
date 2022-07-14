docker info > /dev/null 2>&1

# Ensure that Docker is running...
if [ $? -ne 0 ]; then
    echo "Docker is not running."

    exit 1
fi

docker run --rm --interactive --tty   --volume $PWD:/app   composer install

if sudo -n true 2>/dev/null; then
    sudo chown -R $USER: .
else
    echo -e "${WHITE}Please provide your password so we can make some final adjustments to your application's permissions.${NC}"
    echo ""
    sudo chown -R $USER: .
    echo ""
fi

cp .env.example .env

./vendor/bin/sail up -d & ./vendor/bin/sail artisan migrate

echo "Setup Done Succesfully, services are up and running."
