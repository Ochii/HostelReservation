Write-Output "Installing back-end libraries..."
composer install

Write-Output "Installing front-end libraries..."
yarn install --modules-folder ./public/vendor
