## Zine.Api

- Written in PHP using Laravel Octane with Swoole
- Caching system based on Redis / SwooleTable
- Backend provides low response and can withstand significant loads

##### Installation

Make sure that you have make, docker and docker compose installed on the host system

Install:
```bash
make install
```

To choose another env:
```bash
make install env=production
```

Run migrations:
```bash
make artisan-migrate
```

All available commands are listed in the Makefile

To pass variable use syntax below:
```bash
# Followed command creates App/ModuleName/Http/Controllers/EntityNameController 
make artisan-controller module=ModuleName name=EntityName
```


