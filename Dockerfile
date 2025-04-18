# Use an official PHP image with Apache
FROM php:8.1-apache

# Copy all files into the Apache server's root directory
COPY . /var/www/html/

# Ensure proper permissions for your data.json if it needs to be writable
RUN chmod 666 /var/www/html/data.json

# Expose port 80 (default web port)
EXPOSE 80
