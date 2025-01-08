FROM node:12

# 設置工作目錄
WORKDIR /var/www/app

# 安裝 Quasar CLI
RUN npm install -g @quasar/cli@1.4.0

# 複製專案到容器內
COPY ./volume/frontend /var/www/app

# 安裝依賴
RUN npm install

CMD ["quasar", "dev"]
