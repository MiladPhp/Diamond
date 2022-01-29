curl "https://api.telegram.org/bot${5147475755:AAGBEkYmWzDEK6yMoucbVys5HEeAKJMabAo}/setWebhook?url=$(gcloud run services describe bot --format 'value(status.url)' --project ${777997288})"
