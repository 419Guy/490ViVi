from scrapy.spider import BaseSpider
from scrapy.contrib.linkextractors import LinkExtractor
from scrapy.contrib.spiders import CrawlSpider, Rule
from scrapy.utils.markup import remove_tags
from scrapy.selector import Selector
from scrapy.selector import HtmlXPathSelector
from bkstr.items import BkstrItem
from scrapy.http import Request
from scrapy.loader.processors import Join
import csv
import sys


class MySpider(CrawlSpider):
        name = "evenbook"
	#l = []
        my_file = open("callnumberedited3.csv", "rb")
	reader = csv.reader(my_file)
        #delimiter =  ","
	#for row in reader:
        	#append(row)
	#yield row
    	#print l[0]
	#allowed_domains = my_file#Perhaps the lack of this was causing the excess search
    	start_urls = my_file
	custom_settings = {'REDIRECT_ENABLED': False}
	handle_httpstatus_list = [301]
    	download_delay = 0.25
    	rules = [Rule(LinkExtractor(), follow=True, callback='parse_item')]


	#def start_requests(self):#An attempt at stopping the redirects
	#	for url in self.start_urls:
	#		yield Request(url, meta={'dont_redirect':True})
        
	def parse_item (self, response):
                hxs = HtmlXPathSelector(response)
                titles = hxs.xpath('//*[id="fldset-store_1"]')
                items = []
                for titles in titles:
                	item = BkstrItem()
                        item["course"] = titles.xpath('//*[@id="fldset-course_1_1"]/div[2]/h2/text()').extract()[0].strip()
                        item["title1"] = titles.xpath('//*[@id="fldset-crsmaterialgrp_1"]/div[1]/h3/text()').extract()[0].strip() or [u'N/A']
			item["author1"] = titles.xpath('//*[@id="materialAuthor"]/text()').extract()[0].strip() or [u'N/A']
			item["author2"] = titles.xpath('//*[@id="materialAuthor"]/text()').extract()[1].strip() or [u'N/A']
			item["isbn1"] = titles.xpath('//*[@id="materialISBN"]/text()').extract()[0].strip() or [u'N/A']
			item["isbn2"] = sel.xpath('//*[@id="materialISBN"]/text()').extract()[1].strip() or [u'N/A']
			item["year1"] = sel.xpath('//*[@id="materialCopyrightYear"]/text()').extract()[0].strip() or [u'N/A']
			item["year2"] = sel.xpath('//*[@id="materialCopyrightYear"]/text()').extract()[1].strip() or [u'N/A']
			item["publisher1"] = sel.xpath('//*[@id="materialPublisher"]/strong/text()').extract()[0].strip() or [u'N/A']
			item["publisher2"] = sel.xpath('//*[@id="materialPublisher"]/strong/text()').extract()[1].strip() or [u'N/A']   
			item["title2"] = sel.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3/text()').extract()[0].strip() or [u'N/A']
			item["title3"] = sel.xpath('//*[@id="fldset-crsmaterialgrp_3"]/div[1]/h3/text()').extract()[0].strip() or [u'N/A']
			item["type1a"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[2]/text()').extract()[0].strip()
			item["type1b"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[2]/text()').extract()[0].strip()
			item["type1c"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[2]/text()').extract()[0].strip()
			item["type1d"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[2]/text()').extract()[0].strip()
			item["type1e"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[2]/text()').extract()[0].strip()
			item["buyrent1a"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[3]/text()').extract()[0].strip()
			item["buyrent1b"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[3]/text()').extract()[0].strip()
			item["buyrent1c"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[3]/text()').extract()[0].strip()
			item["buyrent1d"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[3]/text()').extract()[0].strip()
			item["buyrent1e"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[3]/text()').extract()[0].strip()
			item["option1a"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[4]/text()').extract()[0].strip()
			item["option1b"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[4]/text()').extract()[0].strip()	
			item["option1c"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[4]/text()').extract()[0].strip()
			item["option1d"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[4]/text()').extract()[0].strip()
			item["option1e"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[4]/text()').extract()[0].strip()
			item["price1a"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[8]/text()').extract()[0].strip()
			item["price1b"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[8]/text()').extract()[0].strip()
			item["price1c"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[8]/text()').extract()[0].strip()
			item["price1d"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[8]/text()').extract()[0].strip()
			item["price1e"] = sel.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[8]/text()').extract()[0].strip()
			item["type2a"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[2]/text()').extract()[0].strip()
			item["type2b"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[2]/text()').extract()[0].strip()
			item["type2c"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[2]/text()').extract()[0].strip()
			item["type2d"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[2]/text()').extract()[0].strip()
			item["type2e"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[2]/text()').extract()[0].strip()
			item["buyrent2a"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[3]/text()').extract()[0].strip()
			item["buyrent2b"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[3]/text()').extract()[0].strip()
			item["buyrent2c"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[3]/text()').extract()[0].strip()
			item["buyrent2d"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[3]/text()').extract()[0].strip()
			item["buyrent2e"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[3]/text()').extract()[0].strip()
			item["option2a"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[4]/text()').extract()[0].strip()
			item["option2b"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[4]/text()').extract()[0].strip()
			item["option2c"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[4]/text()').extract()[0].strip()
			item["option2d"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[4]/text()').extract()[0].strip()
			item["option2e"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[4]/text()').extract()[0].strip()
			item["price2a"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[8]/text()').extract()[0].strip()
			item["price2b"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[8]/text()').extract()[0].strip()
			item["price2c"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[8]/text()').extract()[0].strip()
			item["price2d"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[8]/text()').extract()[0].strip()
			item["price2e"] = sel.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[8]/text()').extract()[0].strip()
			item["type3a"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[2]/text()').extract()[0].strip()
			item["type3b"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[2]/text()').extract()[0].strip()
			item["type3c"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[2]/text()').extract()[0].strip()
			item["type3d"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[2]/text()').extract()[0].strip()
			item["type3e"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[2]/text()').extract()[0].strip()
			item["buyrent3a"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[3]/text()').extract()[0].strip()
			item["buyrent3b"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[3]/text()').extract()[0].strip()
			item["buyrent3c"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[3]/text()').extract()[0].strip()
			item["buyrent3d"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[3]/text()').extract()[0].strip()
			item["buyrent3e"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[3]/text()').extract()[0].strip()
			item["option3a"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[4]/text()').extract()[0].strip()
			item["option3b"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[4]/text()').extract()[0].strip()
			item["option3c"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[4]/text()').extract()[0].strip()
			item["option3d"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[4]/text()').extract()[0].strip()
			item["option3e"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[4]/text()').extract()[0].strip()
			item["price3a"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[8]/text()').extract()[0].strip()		
			item["price3b"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[8]/text()').extract()[0].strip()
			item["price3c"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[8]/text()').extract()[0].strip()
			item["price3d"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[8]/text()').extract()[0].strip()
			item["price3e"] = sel.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[8]/text()').extract()[0].strip()
			items.append(item)
		yield(items)
                

