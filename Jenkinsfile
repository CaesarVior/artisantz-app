pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build & Deploy') {
            steps {
                echo 'Building and starting containers...'
                sh 'cp .env.staging .env'
                sh 'docker compose down -v'
                sh 'docker compose up -d --build'
            }
        }

        stage('Laravel Post-Deployment') {
            steps {
                echo 'Waiting for database to be fully ready...'
                sh 'until docker exec main-mysql-container mysqladmin ping --silent; do echo "Waiting for MySQL..."; sleep 2; done'
                sh 'docker exec artisantz-app-container php artisan migrate'
                sh 'docker exec artisantz-app-container php artisan optimize:clear'
            }
        }
    }

    post {
        success {
            discordSend(
                description: "Branch: ${env.APP_ENV}\nBuild: ${env.BUILD_NUMBER}\nStatus: success\n\n*No changes.*\n\n**Artifacts:**\n\n*No artifacts saved.*", 
                footer: "Jenkins v2.528.3, Discord Notifier v264.v70060b_a_b_d300", 
                link: env.BUILD_URL, 
                result: 'SUCCESS', 
                title: "${env.JOB_NAME} #${env.BUILD_NUMBER}", 
                webhookURL: "https://discord.com/api/webhooks/1354805761280315442/WBWj1zEx8LaM5SYJVJcVrW49n4M20BA4dUUg6gm9CXsoBECKnwbAm7m0wevYo4ORKOpd",
                notes: "<@869558551436210207> <@1491314589835591811> <@776248115073122334> <@995911519407722576> 🚀 Build selesai!"
            )
        }
        failure {
            discordSend(
                description: "Branch: ${env.APP_ENV}\nBuild: ${env.BUILD_NUMBER}\nStatus: failure\n\n**Artifacts:**\n\n*No artifacts saved.*", 
                footer: "Jenkins v2.528.3, Discord Notifier v264.v70060b_a_b_d300", 
                link: env.BUILD_URL, 
                result: 'FAILURE', 
                title: "${env.JOB_NAME} #${env.BUILD_NUMBER}", 
                webhookURL: "https://discord.com/api/webhooks/1354805761280315442/WBWj1zEx8LaM5SYJVJcVrW49n4M20BA4dUUg6gm9CXsoBECKnwbAm7m0wevYo4ORKOpd",
                notes: "<@869558551436210207> <@1491314589835591811> <@776248115073122334> <@995911519407722576> ❌ Build gagal!"
            )
        }
    }
}