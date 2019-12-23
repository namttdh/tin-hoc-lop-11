FROM node:11-alpine

RUN mkdir -p /usr/src/app

RUN mkdir -p /usr/src/app/node_modules

WORKDIR /usr/src/app

COPY . .

RUN npm install

EXPOSE 3000

CMD ["npm", "run", "start"]
