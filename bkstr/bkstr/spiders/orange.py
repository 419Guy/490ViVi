from scrapy.spider import BaseSpider
from scrapy.contrib.linkextractors import LinkExtractor
from scrapy.contrib.spiders import CrawlSpider, Rule
from scrapy.utils.markup import remove_tags
from scrapy.selector import Selector
from scrapy.selector import HtmlXPathSelector
from bkstr.items import BkstrItem
from scrapy.http import Request
import csv
import sys


class MySpider(CrawlSpider):
        name = "book"
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
    	#download_delay = 1
    	rules = [Rule(LinkExtractor(), follow=True, callback='parse_item')]

        def parse_item (self, response):
                #hxs = HtmlXPathSelector(response)
                #titles = select.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3')
                #items = []
		varx = response.xpath('//*[@id="fldset-course_1_1"]/div[2]/h2/text()')
                for sel in response.xpath('//*[@id="fldset-course_1_1"]/div[2]/h2/text()'):
                        item = BkstrItem()
                        item["course"] = varx.extract()[0].strip()
                        yield item

                var1 = response.xpath('//*[@id="fldset-crsmaterialgrp_1"]/div[1]/h3/text()') 
		#var2 = response.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3/text()')
		#var3 = response.xpath('//*[@id="fldset-crsmaterialgrp_3"]/div[1]/h3/text()')

                for sel in response.xpath('//*[@id="fldset-crsmaterialgrp_1"]/div[1]/h3/text()'):
                        item = BkstrItem()
                        item["title1"] = var1.extract()[0].strip()
			yield item
                #yield item
		var11 = response.xpath('//*[@id="materialAuthor"]/text()')
                for sel in response.xpath('//*[@id="materialAuthor"]/text()'):
                        item = BkstrItem()
                        item["author1"] = var11.extract()[0].strip()
                        yield item
		var12 = response.xpath('//*[@id="materialISBN"]/text()')
                for sel in response.xpath('//*[@id="materialISBN"]/text()'):
                        item = BkstrItem()
			item["isbn1"] = var12.extract()[0].strip()
                        yield item
		var13 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[8]/text()'):
                        item = BkstrItem()
                        item["price1"] = var13.extract()[0].strip()
                        yield item

                var2 = response.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3/text()')
                for sel in response.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3/text()'):
                        item = BkstrItem()
                        item["title2"] = var2.extract()[0].strip()
                	yield item
		var21 = response.xpath('//*[@id="materialAuthor"]/text()')
                for sel in response.xpath('//*[@id="materialAuthor"]/text()'):
                        item = BkstrItem()
                        item["author2"] = var21.extract()[0].strip()
                        yield item
		var22 = response.xpath('//*[@id="materialISBN"/text()')
                for sel in response.xpath('//*[@id="materialISBN"]/text()'):
                        item = BkstrItem()
                        item["isbn2"] = var22.extract()[0].strip()
                        yield item
		var23 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[8]/text()'):
                        item = BkstrItem()
                        item["price2"] = var23.extract()[0].strip()
                        yield item



                var3 = response.xpath('//*[@id="fldset-crsmaterialgrp_3"]/div[1]/h3/text()')
                for sel in response.xpath('//*[@id="fldset-crsmaterialgrp_3"]/div[1]/h3/text()'):
                        item = BkstrItem()
                        item["title3"] = var3.extract()[0].strip()
                	yield item
		var31 = response.xpath('//*[@id="materialAuthor"]/text()')
                for sel in response.xpath('//*[@id="materialAuthor"]/text()'):
                        item = BkstrItem()
                        item["author3"] = var31.extract()[0].strip()
                        yield item
		var32 = response.xpath('//*[@id="materialISBN"]/text()')
                for sel in response.xpath('//*[@id="materialISBN"]/text()'):
                        item = BkstrItem()
                        item["isbn3"] = var32.extract()[0].strip()
                        yield item
		var33 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[8]/text()'):
                        item = BkstrItem()
                        item["price3"] = var33.extract()[0].strip()
                        yield item




