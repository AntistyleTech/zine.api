## Zine.Api

- Written in PHP using Laravel Octane
- Caching system based on Redis
- Backend provides low response and can withstand significant loads

##### Installation

Configure your local hosts by editing the `/etc/hosts` file. For instance:

```
127.0.0.1 zine.local
```

Make sure that you have make, docker and docker compose installed on the host system

Clone and install Traefik container [proxy](https://github.com/AntistyleTech/zine.proxy)

```bash
cd ..
git clone https://github.com/AntistyleTech/zine.infra
cd zine.infra && make install
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
```

```bash
# with available args:
make exec container=app uid=1000 gid=1000 env=local
```


Laravel App developed using [LaravelModules](https://github.com/nWidart/laravel-modules)
[LaravelModulesDocs](https://laravelmodules.com/docs/v11)

All artisan module commands listed [here](https://laravelmodules.com/docs/v11/artisan-commands)

All modules stored in /modules (Modules\*)

Laravel application dir /app (App\*) folder used for shared abstract classes and interfaces

Available make commands are listed in the [Makefile](Makefile)

Telescope debug assistant dashboard available at [Telescope](http://api.host.local/telescope)

Api documentation available at [ApiDocs](http://api.host.local/docs/api)

To handle external callbacks you will need a public url
You can use ngrok:

```bash
ngrok http --host-header=localhost 80
```

Set a public domain add to .env.local

```dotenv
TUNNEL_DOMAIN=https://XXX-XXX-XXX-XXX.ngrok-free.app
```

