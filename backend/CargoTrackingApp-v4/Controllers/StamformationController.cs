using Microsoft.AspNetCore.Mvc;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using CargoTrackingApp_v4.Data;
using CargoTrackingApp_v4.Models;
using Microsoft.EntityFrameworkCore;

namespace CargoTrackingApp_v4.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class StamformationController : ControllerBase
    {
        private readonly ApplicationDbContext _context;

        public StamformationController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: api/Stamformation
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Stamformation>>> GetStamformations()
        {
            return await _context.Stamformations.ToListAsync();
        }

        // GET: api/Stamformation/1
        [HttpGet("{id}")]
        public async Task<ActionResult<Stamformation>> GetStamformation(int id)
        {
            var stamformation = await _context.Stamformations.FindAsync(id);

            if (stamformation == null)
            {
                return NotFound();
            }

            return stamformation;
        }

        // PUT: api/Stamformation/1
        [HttpPut("{id}")]
        public async Task<IActionResult> PutStamformation(int id, Stamformation stamformation)
        {
            if (id != stamformation.StamformationId)
            {
                return BadRequest();
            }

            _context.Entry(stamformation).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!StamformationExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/Stamformation
        [HttpPost]
        public async Task<ActionResult<Stamformation>> PostStamformation(Stamformation stamformation)
        {
            _context.Stamformations.Add(stamformation);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetStamformation", new { id = stamformation.StamformationId }, stamformation);
        }

        // DELETE: api/Stamformation/1
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteStamformation(int id)
        {
            var stamformation = await _context.Stamformations.FindAsync(id);
            if (stamformation == null)
            {
                return NotFound();
            }

            _context.Stamformations.Remove(stamformation);
            await _context.SaveChangesAsync();

            return NoContent();
        }

        private bool StamformationExists(int id)
        {
            return _context.Stamformations.Any(e => e.StamformationId == id);
        }
    }
}