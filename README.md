git status
git add .
git commit -m "start 1"
git push origin main

git checkout de91021
git checkout -b temp-quiz-1
git checkout main
git merge temp-quiz-1
git branch -d temp-quiz-1
git push origin main

git checkout -b recover-fabb5f4 fabb5f4

php artisan migrate
php artisan migrate:rollback
php artisan migrate:refresh
php artisan migrate:refresh --seed

npm install tailwindcss @tailwindcss/vite

php artisan serv
npm run dev
php artisan config:clear
php artisan route:clear
php artisan cache:clear

git branch
git checkout main
git merge 0b17bac
git push origin main
