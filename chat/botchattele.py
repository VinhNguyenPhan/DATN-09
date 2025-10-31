import requests
TOKEN = "8430398623:AAG6Sstcya8scqUVSwNZUENQdvDl8uIUdVA"
chatid= 8005199440
message = "Xin chào, tôi là Chuyên viên CSKH của U and I logistic miền Bắc"
url = f"https://api.telegram.org/bot{TOKEN}/sendMessage?chat_id={chatid}&text={message}"
r = requests.get(url)