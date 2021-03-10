FROM node:10

# build vue app
RUN mkdir -p /usr/src/frontend
COPY ./frontend /usr/src/frontend
WORKDIR /usr/src/frontend

RUN apt update
RUN apt-get install -yq gconf-service libasound2 libatk1.0-0 libc6 libcairo2 libcups2 libdbus-1-3 \
libexpat1 libfontconfig1 libgcc1 libgconf-2-4 libgdk-pixbuf2.0-0 libglib2.0-0 libgtk-3-0 libnspr4 \
libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 \
libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 \
ca-certificates fonts-liberation libappindicator1 libnss3 lsb-release xdg-utils wget

# image compression
RUN apt install -y jpegoptim
RUN find /usr/src/frontend/src/assets/images/ -type f -iname "*.jpg" -exec jpegoptim -m60 {} +

RUN apt install -y optipng pngcrush
RUN find /usr/src/frontend/src/assets/images/ -type f -iname "*.png" -exec optipng -nb -nc {} \;
RUN find /usr/src/frontend/src/assets/images/ -type f -iname "*.png" -exec pngcrush -rem gAMA -rem alla -rem cHRM -rem iCCP -rem sRGB -rem time -ow {} \;

RUN npm install
RUN npm run build