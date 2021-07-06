# Entropy-Extension

phpBB 3.2/3.3 Extension to message new posts to Mattermost/Slack/Discord channel with incoming hooks. Optionally adds new "View Active Topics"-link before main breadcrumb navigation

# Requirements
php-curl extension

# Install
1. Clone to [phpBBroot]/ext/haivala/entropy
2. Activate
3. Set incoming hook, botname, botimg and optionally channel in ACP

# Upgrade from 1.1 to 1.2
The installation directory has been changed so it recommended that the extension is uninstalled and deleted before upgrading it to 1.2. You need to setup the webhooks again.
