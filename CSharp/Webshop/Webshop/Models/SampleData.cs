using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Data.Entity;

namespace Webshop.Models
{
    public class SampleData : DropCreateDatabaseIfModelChanges<StoreEntities>
    {
        protected override void Seed(StoreEntities context)
        {
            var categories = new List<Category>
            {
                new Category { Name = "Kijelző", PictureURL = "mock_monitor" },
                new Category { Name = "Merevlemez", PictureURL = "mock_hdd" },
                new Category { Name = "Processzor", PictureURL = "mock_cpu" },
                new Category { Name = "Memóriakártya", PictureURL = "mock_ram" }
            };

            categories.ForEach(c => context.Categories.Add(c));

            context.SaveChanges();

            new List<Product>
            {
                new Product { Name = "Asus VP247T", Category = categories.Single(c => c.Name == "Kijelző"), Price = 43990},
                new Product { Name = "Asus VX279H", Category = categories.Single(c => c.Name == "Kijelző"), Price = 69990},
                new Product { Name = "BenQ GC2870H", Category = categories.Single(c => c.Name == "Kijelző"), Price = 59990},
                new Product { Name = "WD Blue", Category = categories.Single(c => c.Name == "Merevlemez"), Price = 16490},
                new Product { Name = "Seagate ST2000DM001", Category = categories.Single(c => c.Name == "Merevlemez"), Price = 23990},
                new Product { Name = "Sony HD-B1BEU", Category = categories.Single(c => c.Name == "Merevlemez"), Price = 27990},
                new Product { Name = "Intel Core i7-6700K", Category = categories.Single(c => c.Name == "Processzor"), Price = 117990},
                new Product { Name = "AMD FX 8350", Category = categories.Single(c => c.Name == "Processzor"), Price = 55990},
                new Product { Name = "Intel Core i5-4460", Category = categories.Single(c => c.Name == "Processzor"), Price = 58990},
                new Product { Name = "Kingston HyperX FURY Black", Category = categories.Single(c => c.Name == "Memóriakártya"), Price = 20990},
                new Product { Name = "Corsair Vengeance LPX Black", Category = categories.Single(c => c.Name == "Memóriakártya"), Price = 36990},
                new Product { Name = "Kingston HyperX Predator", Category = categories.Single(c => c.Name == "Memóriakártya"), Price = 27990}
            }.ForEach(p => context.Products.Add(p));

            context.SaveChanges();
        }
    }
}