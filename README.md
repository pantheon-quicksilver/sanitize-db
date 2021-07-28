# Sanitize Database

This script is used to sanitize user data after cloning the database into a non-production environment. Behind the scenes, it uses Drush's `sql-sanitize` function for Drupal sites, and a special query in WordPress (referenced originally by this [blog post](http://crackingdrupal.com/blog/greggles/creating-sanitized-drupal-database-dump#comment-164)).

### Installation

This project is designed to be included from a site's `composer.json` file, and placed in its appropriate installation directory by [Composer Installers](https://github.com/composer/installers).

In order for this to work, you should have the following in your composer.json file:

```json
{
  "require": {
    "composer/installers": "^1"
  },
  "extra": {
    "installer-paths": {
      "web/private/scripts/quicksilver": ["type:quicksilver-script"]
    }
  }
}
```

The project can be included by using the command:

`composer require pantheon-quicksilver/sanitize-db`

### Example `pantheon.yml`

```yaml
api_version: 1

workflows:
  clone_database:
    after:
      - type: webphp
        description: Sanitize database
        script: private/scripts/quicksilver/pantheon-quicksilver/sanitize-db.php
```
