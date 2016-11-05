# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

#import scrapy
from scrapy.item import Item, Field

class BkstrItem(Item):
	title1 = Field()
	author1 = Field()
	isbn1 = Field()
	price1 = Field()
	title2 = Field()
	author2 = Field()
	isbn2 = Field()
	price2 = Field()
	title3 = Field()
	author3 = Field()
	isbn3 = Field()
	price3 = Field()


