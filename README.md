## Zine.Api

- Written in PHP using Laravel Octane
- Caching system based on Redis
- Backend provides low response and can withstand significant loads

##### Installation

Configure your local hosts by editing the `/etc/hosts` file. For instance:

```
127.0.0.1 api.host.local
127.0.0.1 web.host.local
```

Make sure that you have make, docker and docker compose installed on the host system

Clone and install Traefik container [proxy](https://github.com/AntistyleTech/zine.proxy)

```bash
cd ..
git clone https://github.com/AntistyleTech/zine.proxy
cd zine.proxy && make install
```

Check Traefik installation
Visit dashboard at [localhost:8080](http://localhost:8080)

Install:

```bash
make install
```

To choose .env.production:

```bash
make install env=production
```

Run migrations:

```bash
make artisan-migrate
```

To check application installation visit: [Api check up](http://api.host.local/up)

To exec bash commands via container:

```bash
make exec

# with available args:
make exec container=app uid=1000 gid=1000 env=local
```

Available make commands are listed in the [Makefile](Makefile)

Telescope debug assistant dashboard available at [Telescope](http://api.host.local/telescope)

Api documentation available at [ApiDocs](http://api.host.local/docs/api)
