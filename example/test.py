'''
	* Web Scraping With Python3
	* You Need Work By Library Requests & RegEx In Library Re & Json
'''
try:
	import requests, re, json
	headers = {
		'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; WebScraping; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36)',
	}
	content = requests.get('https://who.is/whois/google.com',headers=headers).text
	regExKey = re.findall('<div class="col-md-4 queryResponseBodyKey">(.*)</div>',content)
	del regExKey[3]
	regExValue = re.findall('<div class="col-md-8 queryResponseBodyValue">(.*)</div>',content)
	if regExValue[1] != '':
		i = 0
		array = list()
		for value in regExKey:
			array.append({value:regExValue[i]})
			++i
		result = {
			'ok':True,
			'result':array,
		}
	else:
		result = {
			'ok':False,
		}
	print(json.dumps(result))
except:
	print('Error 403/:')