
from scrapy.spiders import BaseSpider
from scrapy.selector import HtmlXPathSelector
from njitcourses.items import NjitcoursesItem


class MySpider(BaseSpider):
        name = "course"
        allowed_domains = ["courseschedules.njit.edu"]
        start_urls = ["http://courseschedules.njit.edu/index.aspx?semester=2016f"]

        def parse (self, response):
                hxs = HtmlXPathSelector(response)
                titles = hxs.xpath("//span")
                items = []
                for titles in titles:
                        item = NjitcoursesItem()
                        item["title"] = titles.select("a/text()").extract()
                        item["link"] = titles.select("a/@href").extract()
                        items.append(item)
                return items
